// App.js
import React, { useState } from 'react';
import { View, StyleSheet } from 'react-native';

import Home from './pages/Home';
import Login from './pages/Login';
import Register from './pages/Register';
import ViewSuggestions from './pages/ViewSuggestions';
import SubmitSuggestion from './pages/SubmitSuggestion';
import ViewIndividualSuggestion from './pages/ViewIndividualSuggestion';
import UpdateSuggestion from './pages/UpdateSuggestion';

export default function App() {
  const [screen, setScreen] = useState('home');
  const [selectedId, setSelectedId] = useState(null);

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
        <ViewSuggestions
          onNavigateBack={() => setScreen('home')}
          onNavigateToSubmit={() => setScreen('submit')}
          onNavigateToView={(id) => {
            setSelectedId(id);
            setScreen('viewSingle');
          }}
          onNavigateToUpdate={(id) => {
            setSelectedId(id);
            setScreen('update');
          }}
        />
      )}
      {screen === 'submit' && (
        <SubmitSuggestion onNavigateBack={() => setScreen('suggestions')} />
      )}
      {screen === 'viewSingle' && selectedId !== null && (
        <ViewIndividualSuggestion
          id={selectedId}
          onNavigateBack={() => setScreen('suggestions')}
        />
      )}
      {screen === 'update' && selectedId !== null && (
        <UpdateSuggestion
          id={selectedId}
          onNavigateBack={() => setScreen('suggestions')}
        />
      )}
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
});
