// ViewSuggestions.jsx
import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  ScrollView,
  ActivityIndicator,
  TouchableOpacity,
  Alert,
} from 'react-native';
import { BASE_URL } from '../config';

const ViewSuggestions = ({ onNavigateBack }) => {
  const [suggestions, setSuggestions] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`${BASE_URL}/suggestions.php`)
      .then((response) => response.json())
      .then((data) => {
        setSuggestions(data);
        setLoading(false);
      })
      .catch((error) => {
        console.error('Error fetching suggestions:', error);
        setLoading(false);
      });
  }, []);

  const handleDelete = (id) => {
    Alert.alert('Confirm Delete', 'Are you sure you want to delete this?', [
      {
        text: 'Cancel',
        style: 'cancel',
      },
      {
        text: 'Delete',
        style: 'destructive',
        onPress: () => {
          fetch(`${BASE_URL}/delete_suggestion.php?id=${id}`, {
            method: 'GET',
          })
            .then(() => {
              setSuggestions((prev) =>
                prev.filter((item) => item.id !== id)
              );
              Alert.alert('Deleted!', 'The entry was deleted.');
            })
            .catch((err) => {
              console.error('Delete failed:', err);
              Alert.alert('Error', 'Failed to delete the suggestion.');
            });
        },
      },
    ]);
  };

  return (
    <ScrollView style={styles.container}>
      <Text style={styles.title}>Learning Preferences</Text>

      <TouchableOpacity
        onPress={() => Alert.alert('Redirect', 'Navigate to submit form here')}
        style={styles.submitButton}
      >
        <Text style={styles.submitButtonText}>➕ Submit New Preference</Text>
      </TouchableOpacity>

      <TouchableOpacity
        onPress={onNavigateBack}
        style={styles.homeButton}
      >
        <Text style={styles.homeButtonText}>🏠 Back to Home</Text>
      </TouchableOpacity>

      {loading ? (
        <ActivityIndicator size="large" color="#007bff" />
      ) : (
        <View style={styles.table}>
          <View style={styles.rowHeader}>
            <Text style={styles.cellHeader}>ID</Text>
            <Text style={styles.cellHeader}>Username</Text>
            <Text style={styles.cellHeader}>Concept</Text>
            <Text style={styles.cellHeader}>Theme</Text>
            <Text style={styles.cellHeader}>Action</Text>
          </View>
          {suggestions.map((item) => (
            <View key={item.id} style={styles.row}>
              <Text style={styles.cell}>{item.id}</Text>
              <Text style={styles.cell}>{item.username}</Text>
              <Text style={styles.cell}>{item.coding_concept}</Text>
              <Text style={styles.cell}>{item.theme}</Text>
              <View style={styles.cell}>
                <TouchableOpacity
                  onPress={() =>
                    Alert.alert('View', `Viewing ID: ${item.id}`)
                  }
                >
                  <Text style={styles.actionLink}>View</Text>
                </TouchableOpacity>
                <Text> | </Text>
                <TouchableOpacity
                  onPress={() =>
                    Alert.alert('Update', `Navigating to update ID: ${item.id}`)
                  }
                >
                  <Text style={[styles.actionLink, { color: 'orange' }]}>
                    Update
                  </Text>
                </TouchableOpacity>
                <Text> | </Text>
                <TouchableOpacity onPress={() => handleDelete(item.id)}>
                  <Text style={[styles.actionLink, { color: 'red' }]}>
                    Delete
                  </Text>
                </TouchableOpacity>
              </View>
            </View>
          ))}
        </View>
      )}
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: { padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  table: { borderWidth: 1, borderColor: '#ccc' },
  rowHeader: {
    flexDirection: 'row',
    backgroundColor: '#f2f2f2',
    borderBottomWidth: 1,
    borderColor: '#ccc',
  },
  row: {
    flexDirection: 'row',
    borderBottomWidth: 1,
    borderColor: '#ccc',
  },
  cellHeader: {
    flex: 1,
    fontWeight: 'bold',
    padding: 10,
  },
  cell: {
    flex: 1,
    padding: 10,
  },
  submitButton: {
    backgroundColor: '#28a745',
    padding: 10,
    borderRadius: 5,
    alignSelf: 'flex-start',
    marginBottom: 10,
  },
  submitButtonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
  },
  homeButton: {
    backgroundColor: '#007bff',
    padding: 10,
    borderRadius: 5,
    alignSelf: 'flex-start',
    marginBottom: 20,
  },
  homeButtonText: {
    color: 'white',
    fontSize: 16,
    fontWeight: 'bold',
  },
  actionLink: {
    color: 'blue',
    fontWeight: 'bold',
  },
});

export default ViewSuggestions;
