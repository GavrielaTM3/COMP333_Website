// App.js
import React, { useState } from 'react';
import { View, StyleSheet } from 'react-native';
import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';


export default function App() {
  const [screen, setScreen] = useState('home'); // Options: 'home' or 'login'

  return (
    <View style={styles.container}>
      {screen === 'home' && (
        <Home onNavigateToLogin={() => setScreen('login')} />
      )}
      {screen === 'login' && (
  <Login
    onNavigateBack={() => setScreen('home')}
    onNavigateToRegister={() => setScreen('register')}
  />
)}
      {screen === 'register' && (
        <Register onNavigateBack={() => setScreen('login')} />
      )}    
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
