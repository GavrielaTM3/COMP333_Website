import React, { useState } from 'react';
import { View, Text, TextInput, Button, Alert, TouchableOpacity } from 'react-native';
import styles from './styles';
import { BASE_URL } from '../config';

const Login = ({ onNavigateBack }) => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [errorMsg, setErrorMsg] = useState('');

  const handleLogin = async () => {
    if (!username || !password) {
      setErrorMsg('Please fill out the form.');
      return;
    }

    try {
      const response = await fetch(`${BASE_URL}/login.php`
      , {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ username, password }),
      });

      const data = await response.json();
      console.log(data)
      if (data.success) {
        Alert.alert('Login Successful', `Welcome ${data.username}`);
        onNavigateBack();
      } else {
        setErrorMsg(data.message || 'Invalid credentials.');
      }
    } catch (error) {
      console.error(error);
      setErrorMsg('Unable to connect to server.');
    }
  };

  return (
    <View style={styles.loginContainer}>
      <Text style={styles.loginTitle}>Welcome to BlossomTech!</Text>

      <View style={styles.loginCard}>
        <TextInput
          style={styles.loginInput}
          placeholder="Enter username"
          value={username}
          onChangeText={setUsername}
          autoCapitalize="none"
        />
        <TextInput
          style={styles.loginInput}
          placeholder="Enter password"
          value={password}
          onChangeText={setPassword}
          secureTextEntry
        />

        {errorMsg !== '' && <Text style={styles.loginError}>{errorMsg}</Text>}

        <Button title="Submit" onPress={handleLogin} />

        <TouchableOpacity onPress={() => Alert.alert('Redirect to register')}>
          <Text style={styles.loginLink}>Don't have an account? Sign up</Text>
        </TouchableOpacity>

        <View style={{ marginTop: 12 }}>
          <Button title="Back to Home" onPress={onNavigateBack} />
        </View>
      </View>
    </View>
  );
};

export default Login;
