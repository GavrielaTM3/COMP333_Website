import React, { useState } from 'react';
import { View, StyleSheet } from 'react-native';
import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import Suggestions from './pages/ViewSuggestions';

export default function App() {
  const [screen, setScreen] = useState('home');

  return (
    <View style={styles.container}>
      {screen === 'home' && (
        <Home
          onNavigateToLogin={() => setScreen('login')}
          onNavigateToSuggestions={() => setScreen('suggestions')}
        />
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
      {screen === 'suggestions' && (
        <Suggestions onNavigateBack={() => setScreen('home')} />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
