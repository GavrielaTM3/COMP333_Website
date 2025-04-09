import React, { useEffect, useRef, useState } from 'react';
import {
  View,
  Text,
  ScrollView,
  Image,
  TouchableOpacity,
  Alert
} from 'react-native';
import styles from './styles';
import { BASE_URL } from '../config';

const Home = ({ onNavigateToLogin, onNavigateToSuggestions }) => {
  const [username, setUsername] = useState(null);
  const scrollViewRef = useRef(null);

  // Section refs for scroll navigation
  const missionRef = useRef(null);
  const testimonialsRef = useRef(null);
  const startCodingRef = useRef(null);

  // Fetch logged-in user info
  useEffect(() => {
    fetch(`${BASE_URL}/user.php`) 
      .then(res => res.json())
      .then(data => {
        if (data.username) setUsername(data.username);
      })
      .catch(err => console.error('Error fetching user info:', err));
  }, []);

  // Scroll to a section using its ref
  const scrollToSection = ref => {
    ref.current?.measureLayout(
      scrollViewRef.current.getNativeScrollRef(),
      (x, y) => {
        scrollViewRef.current.scrollTo({ x: 0, y, animated: true });
      }
    );
  };

  // Topics available for personalized coding lessons
  const topics = [
    {
      title: 'Biology',
      img: 'https://cdn.pixabay.com/photo/2013/07/18/10/55/dna-163466_1280.jpg'
    },
    {
      title: 'Fashion',
      img: 'https://cdn.pixabay.com/photo/2022/08/25/23/06/woman-7411414_1280.png'
    },
    {
      title: 'Sports',
      img: 'https://cdn.pixabay.com/photo/2025/01/28/09/32/rocket-9365225_1280.jpg'
    },
    {
      title: 'Photography',
      img: 'https://cdn.pixabay.com/photo/2014/12/29/08/29/lens-582605_1280.jpg'
    }
  ];

  // Sample testimonials from fictional users
  const testimonials = [
    {
      name: 'Diana Spenser',
      role: 'Grandmother',
      quote:
        'I am retired and wanted to learn how to code to help my grandkids with their homework.',
      img: 'https://images.pexels.com/photos/6248443/pexels-photo-6248443.jpeg'
    },
    {
      name: 'Richard Montero',
      role: 'Kindergarten student',
      quote:
        'I learned to code to make video games that I now play with my friends.',
      img: 'https://images.pexels.com/photos/8421989/pexels-photo-8421989.jpeg'
    },
    {
      name: 'Sonia Ramirez',
      role: 'CEO',
      quote:
        'After launching my startup, I wanted to learn to code so I could help out my web development team.',
      img: 'https://images.pexels.com/photos/8124235/pexels-photo-8124235.jpeg'
    }
  ];

  return (
    <ScrollView ref={scrollViewRef} style={styles.body}>
      {/* Navigation Bar */}
      <View style={styles.navbar}>
        {username && (
          <TouchableOpacity onPress={() => onNavigateToSuggestions()}>
            <Text style={styles.navItem}>Suggestions</Text>
          </TouchableOpacity>
        )}
        <TouchableOpacity onPress={() => scrollToSection(missionRef)}>
          <Text style={styles.navItem}>Our Mission</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => scrollToSection(testimonialsRef)}>
          <Text style={styles.navItem}>Testimonials</Text>
        </TouchableOpacity>
        <TouchableOpacity onPress={() => scrollToSection(startCodingRef)}>
          <Text style={styles.navItem}>Start Coding</Text>
        </TouchableOpacity>

        {/* User login/logout handling */}
        {username ? (
          <>
            <Text style={[styles.navItem, { color: '#BED8D4' }]}>
              Logged in as: {username}
            </Text>
            <TouchableOpacity
              onPress={async () => {
                try {
                  const response = await fetch(`${BASE_URL}/logout.php`, {
                    method: 'POST',
                    credentials: 'include', // Include session cookie
                  });

                  const text = await response.text();
                  console.log('Logout response:', text);

                  Alert.alert('Logged Out', 'You have been successfully logged out.');
                  setUsername(null); // Clear username state
                } catch (err) {
                  console.error('Logout error:', err);
                  Alert.alert('Error', 'Failed to log out.');
                }
              }}
            >
              <Text style={styles.navItem}>Log Out</Text>
            </TouchableOpacity>
          </>
        ) : (
          <TouchableOpacity onPress={onNavigateToLogin}>
            <Text style={styles.navItem}>Login</Text>
          </TouchableOpacity>
        )}
      </View>

      {/* Mission Section */}
      <View ref={missionRef} style={styles.missionText}>
        <Text style={styles.welcome}>Welcome to BlossomTech</Text>
        <Text style={styles.missionTextParagraph}>
          Our mission is to teach you how to code based on your interests! You
          will have a lot of fun coding and see that it is not that hard. Best
          of all, our website is completely FREE because we believe everyone,
          regardless of their background, should have the opportunity to learn
          how to code.
        </Text>
      </View>

      {/* Topic Selection Section */}
      <View ref={startCodingRef} style={styles.mainContent}>
        <Text style={styles.startCodingTitle}>
          Start your first coding lesson for FREE!
        </Text>
        <View style={styles.container}>
          {topics.map((topic, idx) => (
            <TouchableOpacity key={idx} style={styles.box}>
              <Image source={{ uri: topic.img }} style={styles.boxImage} />
              <Text style={styles.boxTitle}>{topic.title}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </View>

      {/* Testimonials Section */}
      <View ref={testimonialsRef}>
        <Text style={styles.testimonialsTitle}>What people are saying...</Text>
        {testimonials.map((t, idx) => (
          <View key={idx} style={styles.testimonials}>
            <Image source={{ uri: t.img }} style={styles.avatar} />
            <View style={styles.testimonialText}>
              <Text style={styles.testimonialName}>
                {t.name} — {t.role}
              </Text>
              <Text>"{t.quote}"</Text>
            </View>
          </View>
        ))}
      </View>

      {/* Footer */}
      <View style={styles.footer}>
        <Text style={styles.footerText}>
          This is a website created for COMP333 at Wesleyan University. This is
          an exercise.
        </Text>
      </View>
    </ScrollView>
  );
};

export default Home;
