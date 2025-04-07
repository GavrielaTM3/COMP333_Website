import React, { useState } from 'react';
import { View, Text, TextInput, Button, TouchableOpacity, Alert } from 'react-native';
import { BASE_URL } from '../config';
import styles from './styles';

const Register = ({ onNavigateBack }) => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [confirmPassword, setConfirmPassword] = useState('');
  const [errorMsg, setErrorMsg] = useState('');

  const handleRegister = async () => {
    if (!username || !password || !confirmPassword) {
      setErrorMsg('All fields are required.');
      return;
    }

    if (password !== confirmPassword) {
      setErrorMsg('Passwords do not match!');
      return;
    }

    if (password.length < 10) {
      setErrorMsg('Password must be at least 10 characters.');
      return;
    }

    try {
      const response = await fetch(`${BASE_URL}/register.php`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password, confirmPassword })
      });

      const text = await response.text();
      console.log('Register response:', text);

      let data;
      try {
        data = JSON.parse(text);
      } catch (e) {
        console.error('JSON Parse Error:', e);
        setErrorMsg('Unexpected server response.');
        return;
      }

      if (data.success) {
        Alert.alert('Registration successful!', 'You can now log in.');
        onNavigateBack(); // Go back to login or home
      } else {
        setErrorMsg(data.message || 'Registration failed.');
      }

    } catch (error) {
      console.error('Network error:', error);
      setErrorMsg('Could not connect to the server.');
    }
  };

  return (
    <View style={styles.loginContainer}>
      <Text style={styles.loginTitle}>BlossomTech Signup</Text>

      <View style={styles.loginCard}>
        <TextInput
          style={styles.loginInput}
          placeholder="Username"
          value={username}
          onChangeText={setUsername}
        />
        <TextInput
          style={styles.loginInput}
          placeholder="Password"
          value={password}
          onChangeText={setPassword}
          secureTextEntry
        />
        <TextInput
          style={styles.loginInput}
          placeholder="Confirm Password"
          value={confirmPassword}
          onChangeText={setConfirmPassword}
          secureTextEntry
        />

        {errorMsg !== '' && (
          <Text style={styles.loginError}>{errorMsg}</Text>
        )}

        <Button title="Submit" onPress={handleRegister} />

        <TouchableOpacity onPress={onNavigateBack}>
          <Text style={styles.loginLink}>Already have an account? Log in</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
};

export default Register;
