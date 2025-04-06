// App.js
import React, { useState } from 'react';
import { View, Text, Button, StyleSheet } from 'react-native';
import Home from './pages/Home';
import Login from './pages/Login';

export default function App() {
  const [screen, setScreen] = useState('home'); // 'home' or 'login'

  return (
    <View style={styles.container}>
      {screen === 'home' ? (
        <Home onNavigate={() => setScreen('login')} />
      ) : (
        <Login onNavigateBack={() => setScreen('home')} />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
