import { StyleSheet } from 'react-native';

const styles = StyleSheet.create({
  body: {
    backgroundColor: '#BED8D4',
    flex: 1,
  },
  navbar: {
    backgroundColor: '#1e4ca1',
    padding: 10,
    flexDirection: 'row',
    justifyContent: 'center',
    flexWrap: 'wrap',
    gap: 20, // requires React Native >= 0.71
  },
  navItem: {
    color: '#F7F9F9',
    fontSize: 18,
    paddingVertical: 12,
    paddingHorizontal: 20,
    borderRadius: 10,
  },
  missionText: {
    backgroundColor: '#e6f7ff',
    padding: 20,
    borderRadius: 10,
    borderColor: '#ccc',
    borderWidth: 2,
    marginVertical: 50,
    alignSelf: 'center',
    maxWidth: 600,
    shadowColor: '#000',
    shadowOpacity: 0.1,
    shadowOffset: { width: 0, height: 4 },
    shadowRadius: 8,
  },
  welcome: {
    fontWeight: 'bold',
    color: '#333',
    fontSize: 24,
    textAlign: 'center',
  },
  missionTextParagraph: {
    color: '#666',
    fontSize: 16,
    textAlign: 'center',
  },
  mainContent: {
    marginTop: 40,
    alignItems: 'center',
  },
  startCodingTitle: {
    textAlign: 'center',
    fontSize: 24,
    color: '#000000',
    marginBottom: 20,
  },
  container: {
    flexDirection: 'row',
    justifyContent: 'space-around',
    flexWrap: 'wrap',
    gap: 12,
  },
  box: {
    backgroundColor: '#ffffff',
    borderRadius: 10,
    width: 200,
    alignItems: 'center',
    margin: 6,
    overflow: 'hidden',
  },
  boxImage: {
    width: '100%',
    height: 150,
    resizeMode: 'cover',
  },
  boxTitle: {
    marginVertical: 10,
    fontSize: 18,
    color: '#060a0d',
  },
  iframeTitle: {
    fontSize: 24,
    fontWeight: 'bold',
    marginBottom: 15,
    textAlign: 'center',
  },
  testimonialsTitle: {
    textAlign: 'center',
    fontSize: 24,
    fontWeight: 'bold',
    marginTop: 20,
  },
  testimonials: {
    flexDirection: 'row',
    alignItems: 'center',
    borderWidth: 2,
    borderColor: '#c1c5cc',
    backgroundColor: '#e0f2f1',
    borderRadius: 25,
    padding: 30,
    marginVertical: 20,
    shadowColor: '#000',
    shadowOpacity: 0.1,
    shadowOffset: { width: 3, height: 3 },
    shadowRadius: 10,
  },
  avatar: {
    width: 100,
    height: 100,
    borderRadius: 50,
    resizeMode: 'cover',
    marginRight: 40,
  },
  testimonialText: {
    flex: 1,
    fontFamily: 'serif',
    color: '#333',
  },
  testimonialName: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 5,
  },
  footer: {
    paddingVertical: 20,
    alignItems: 'center',
  },
  footerText: {
    color: '#080357',
    fontSize: 13,
    lineHeight: 20,
    textAlign: 'center',
  },
});

export default styles;
