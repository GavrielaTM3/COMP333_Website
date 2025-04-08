import React, { useState, useEffect } from 'react';
import { View, TextInput, Button, StyleSheet, Text, Alert } from 'react-native';
import { BASE_URL } from '../config';

const SubmitSuggestion = ({ onNavigateBack }) => {
  const [concept, setConcept] = useState('');
  const [theme, setTheme] = useState('');
  const [username, setUsername] = useState('');

  // Get logged-in username from backend
  useEffect(() => {
    fetch(`${BASE_URL}/user.php`, {
      credentials: 'include',
    })
      .then(res => res.json())
      .then(data => {
        if (data.username) {
          setUsername(data.username);
        } else {
          Alert.alert('Not logged in', 'Please log in to submit a suggestion.');
        }
      })
      .catch(err => console.error('Failed to get user:', err));
  }, []);

  const handleSubmit = () => {
    if (!username || !concept || !theme) {
      Alert.alert('Missing info', 'All fields are required.');
      return;
    }

    fetch(`${BASE_URL}/submit_suggestions.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username, coding_concept: concept, theme }),
    })
      .then(res => res.json())
      .then(response => {
        if (response.success) {
          Alert.alert('Success', 'Suggestion submitted!');
          setConcept('');
          setTheme('');
          onNavigateBack();
        } else {
          Alert.alert('Error', response.error || 'Submission failed.');
        }
      })
      .catch(() => Alert.alert('Error', 'Submission failed.'));
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Submit New Preference</Text>
      <TextInput
        placeholder="Username"
        value={username}
        editable={false}
        style={[styles.input, { backgroundColor: '#f0f0f0' }]}
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
      <Button title="Submit" onPress={handleSubmit} />
      <Button title="Back" onPress={onNavigateBack} color="gray" />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { padding: 20 },
  input: { borderWidth: 1, marginVertical: 10, padding: 10 },
  title: { fontSize: 20, fontWeight: 'bold', marginBottom: 10 },
});

export default SubmitSuggestion;
