import React from 'react';
import ReactDOM from 'react-dom';
import MainPage from './MainPage'; // Change import statement
import './index.css';

ReactDOM.render(
  <React.StrictMode>
    <MainPage /> // Render MainPage component
  </React.StrictMode>,
  document.getElementById('root')
);
