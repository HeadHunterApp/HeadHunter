import React from 'react';
import Navigation from './Navigation';
import LoginModalForm from './LoginModalForm';

const Header = () => {
  return (
    <header>
      <LoginModalForm/>
      <Navigation />
    </header>);
};

export default Header;
