// ViewSuggestions.jsx
import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, ScrollView, ActivityIndicator } from 'react-native';
import { BASE_URL } from '../config';

const ViewSuggestions = () => {
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

  return (
    <ScrollView style={styles.container}>
      <Text style={styles.title}>Learning Preferences</Text>
      {loading ? (
        <ActivityIndicator size="large" color="#007bff" />
      ) : (
        <View style={styles.table}>
          <View style={styles.rowHeader}>
            <Text style={styles.cellHeader}>ID</Text>
            <Text style={styles.cellHeader}>Username</Text>
            <Text style={styles.cellHeader}>Concept</Text>
            <Text style={styles.cellHeader}>Theme</Text>
          </View>
          {suggestions.map((item) => (
            <View key={item.id} style={styles.row}>
              <Text style={styles.cell}>{item.id}</Text>
              <Text style={styles.cell}>{item.username}</Text>
              <Text style={styles.cell}>{item.coding_concept}</Text>
              <Text style={styles.cell}>{item.theme}</Text>
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
});

export default ViewSuggestions;
