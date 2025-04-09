import React, { useEffect, useState } from 'react';
import { View, Text, StyleSheet, ActivityIndicator, Button, Alert } from 'react-native';
import { BASE_URL } from '../config';

const ViewIndividualSuggestion = ({ id, onNavigateBack }) => {
  const [suggestion, setSuggestion] = useState(null);
  const [loading, setLoading] = useState(true);

  // Fetch specific suggestion by ID on component mount
  useEffect(() => {
    fetch(`${BASE_URL}/suggestions.php?id=${id}`)
      .then(res => res.json())
      .then(data => {
        setSuggestion(data);
        setLoading(false);
      })
      .catch(error => {
        console.error('Error fetching suggestion:', error);
        Alert.alert('Error', 'Failed to load suggestion.');
        setLoading(false);
      });
  }, [id]);

  // Show loading spinner while fetching data
  if (loading) {
    return <ActivityIndicator size="large" style={{ marginTop: 50 }} color="#007bff" />;
  }

  // Show fallback message if suggestion was not found
  if (!suggestion) {
    return (
      <View style={styles.container}>
        <Text style={styles.error}>Suggestion not found.</Text>
        <Button title="Back" onPress={onNavigateBack} />
      </View>
    );
  }

  // Display suggestion details
  return (
    <View style={styles.container}>
      <Text style={styles.title}>Suggestion #{suggestion.id}</Text>
      <Text style={styles.label}>Username: {suggestion.username}</Text>
      <Text style={styles.label}>Coding Concept: {suggestion.coding_concept}</Text>
      <Text style={styles.label}>Theme: {suggestion.theme}</Text>
      <Button title="Back" onPress={onNavigateBack} />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { padding: 20 },
  title: { fontSize: 22, fontWeight: 'bold', marginBottom: 20 },
  label: { fontSize: 16, marginBottom: 10 },
  error: { fontSize: 16, color: 'red', marginBottom: 20 },
});

export default ViewIndividualSuggestion;
