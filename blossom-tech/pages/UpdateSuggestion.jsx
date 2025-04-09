import React, { useEffect, useState } from 'react';
import {
  View,
  TextInput,
  Button,
  Text,
  StyleSheet,
  Alert,
  ActivityIndicator,
} from 'react-native';
import { BASE_URL } from '../config';

const UpdateSuggestion = ({ id, onNavigateBack }) => {
  const [username, setUsername] = useState('');
  const [concept, setConcept] = useState('');
  const [theme, setTheme] = useState('');
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    // First, fetch the current suggestion by ID
    fetch(`${BASE_URL}/suggestions.php?id=${id}`)
      .then(res => res.json())
      .then(data => {
        if (data && data.id) {
          setUsername(data.username);
          setConcept(data.coding_concept);
          setTheme(data.theme);
        } else {
          Alert.alert('Error', 'Suggestion not found.');
        }
        setLoading(false);
      })
      .catch(err => {
        console.error('Error loading suggestion:', err);
        setLoading(false);
        Alert.alert('Error', 'Failed to load suggestion.');
      });
  }, [id]);

  const handleUpdate = () => {
    if (!concept || !theme) {
      Alert.alert('Missing fields', 'Please fill out all fields.');
      return;
    }

    fetch(`${BASE_URL}/suggestions.php?id=${id}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        username,
        coding_concept: concept,
        theme,
      }),
    })
      .then(res => res.json())
      .then(response => {
        if (response.success) {
          Alert.alert('Success', 'Suggestion updated!');
          onNavigateBack();
        } else {
          Alert.alert('Error', response.error || 'Update failed.');
        }
      })
      .catch(err => {
        console.error('Update failed:', err);
        Alert.alert('Error', 'Update request failed.');
      });
  };

  if (loading) {
    return <ActivityIndicator size="large" color="#007bff" style={{ marginTop: 50 }} />;
  }

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Update Suggestion #{id}</Text>

      <TextInput
        placeholder="Username"
        value={username}
        editable={false}
        style={[styles.input, { backgroundColor: '#eee' }]}
      />

      <TextInput
        placeholder="Coding Concept"
        value={concept}
        onChangeText={setConcept}
        style={styles.input}
      />

      <TextInput
        placeholder="Theme"
        value={theme}
        onChangeText={setTheme}
        style={styles.input}
      />

      <Button title="Update" onPress={handleUpdate} />
      <Button title="Back" onPress={onNavigateBack} color="gray" />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { padding: 20 },
  input: { borderWidth: 1, padding: 10, marginVertical: 10 },
  title: { fontSize: 20, fontWeight: 'bold', marginBottom: 10 },
});

export default UpdateSuggestion;
