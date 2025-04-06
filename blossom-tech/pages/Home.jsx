import React, { useEffect, useState } from 'react';
import {
  View,
  Text,
  ScrollView,
  Image,
  TouchableOpacity
} from 'react-native';
import styles from './styles'; // your external StyleSheet

const Home = () => {
  const [username, setUsername] = useState(null);

  useEffect(() => {
    fetch('http://localhost/api/user') // Replace with device IP if needed
      .then(res => res.json())
      .then(data => {
        if (data.username) setUsername(data.username);
      })
      .catch(err => console.error('Error fetching user info:', err));
  }, []);

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

  const testimonials = [
    {
      name: 'Diana Spenser',
      role: 'Grandmother',
      quote:
        'I am retired and wanted to learn how to code to help my grandkids with their homework.',
      img: 'https://images.pexels.com/photos/6248443/pexels-photo-6248443.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'
    },
    {
      name: 'Richard Montero',
      role: 'Kindergarten student',
      quote:
        'I learned to code to make video games that I now play with my friends.',
      img: 'https://images.pexels.com/photos/8421989/pexels-photo-8421989.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'
    },
    {
      name: 'Sonia Ramirez',
      role: 'CEO',
      quote:
        'After launching my startup, I wanted to learn to code so I could help out my web development team.',
      img: 'https://images.pexels.com/photos/8124235/pexels-photo-8124235.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2'
    }
  ];

  return (
    <ScrollView style={styles.body}>
      <View style={styles.navbar}>
        {username && <Text style={styles.navItem}>Suggestions</Text>}
        <Text style={styles.navItem}>Our Mission</Text>
        <Text style={styles.navItem}>Testimonials</Text>
        <Text style={styles.navItem}>Start Coding</Text>
        {username ? (
          <>
            <Text style={[styles.navItem, { color: '#BED8D4' }]}>
              Logged in as: {username}
            </Text>
            <Text style={styles.navItem}>Log Out</Text>
          </>
        ) : (
          <Text style={styles.navItem}>Login</Text>
        )}
      </View>

      <View style={styles.missionText}>
        <Text style={styles.welcome}>Welcome to BlossomTech</Text>
        <Text style={styles.missionTextParagraph}>
          Our mission is to teach you how to code based on your interests! You
          will have a lot of fun coding and see that it is not that hard. Best
          of all, our website is completely FREE because we believe everyone,
          regardless of their background, should have the opportunity to learn
          how to code.
        </Text>
      </View>

      <View style={styles.mainContent}>
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

      <View>
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
