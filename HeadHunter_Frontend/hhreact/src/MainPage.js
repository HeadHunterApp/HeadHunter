import React from 'react';
import Header from './Header';
import Navigation from './Navigation';
import Footer from './Footer';
import RightSide from './RightSide';
import LeftSide from './LeftSide';
import './Fooldal.css';




const MainPage = () => {
  return (
    <div>
      <Header />
      <RightSide/>
      <LeftSide/>
      <Footer />
    </div>
  );
};

export default MainPage;
