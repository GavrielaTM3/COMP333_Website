import React, { useState, useEffect } from 'react';
import {
  View,
  TextInput,
  Button,
  StyleSheet,
  Text,
  Alert,
  ActivityIndicator,
} from 'react-native';
import { BASE_URL } from '../config';

const SubmitSuggestion = ({ onNavigateBack }) => {
  const [concept, setConcept] = useState('');
  const [theme, setTheme] = useState('');
  const [username, setUsername] = useState('');
  const [loading, setLoading] = useState(true);

  // Get logged-in username from session (via API)
  useEffect(() => {
    fetch(`${BASE_URL}/user.php`, {
      credentials: 'include', // So session cookie is included
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.username) {
          setUsername(data.username);
        } else {
          Alert.alert('Not Logged In', 'Please log in first.');
        }
        setLoading(false);
      })
      .catch((err) => {
        console.error('Error fetching user:', err);
        Alert.alert('Error', 'Unable to fetch user.');
        setLoading(false);
      });
  }, []);

  const handleSubmit = () => {
    if (!concept || !theme || !username) {
      Alert.alert('Missing Fields', 'Please complete all fields.');
      return;
    }

    fetch(`${BASE_URL}/suggestions.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      credentials: 'include',
      body: JSON.stringify({
        username,
        coding_concept: concept,
        theme,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          Alert.alert('Success', 'Suggestion submitted!');
          setConcept('');
          setTheme('');
          // Navigate back to ViewSuggestions
          onNavigateBack();
        } else {
          Alert.alert('Error', data.error || 'Submission failed.');
        }
      })
      .catch((err) => {
        console.error('Submission error:', err);
        Alert.alert('Error', 'Network request failed.');
      });
  };

  if (loading) {
    return <ActivityIndicator size="large" color="#007bff" style={{ marginTop: 50 }} />;
  }

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Submit New Preference</Text>

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

      <Button title="Submit" onPress={handleSubmit} />
      <Button title="Back" onPress={onNavigateBack} color="gray" />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { padding: 20 },
  input: { borderWidth: 1, padding: 10, marginVertical: 10 },
  title: { fontSize: 20, fontWeight: 'bold', marginBottom: 10 },
});

export default SubmitSuggestion;
