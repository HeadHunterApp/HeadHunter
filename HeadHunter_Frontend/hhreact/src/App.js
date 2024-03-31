import React from 'react';
import Header from './components/Header';
import Main from './components/Main';
import Footer from './components/Footer';
import './styles/App.css';
import VendegLayout from './layout/VendegLayout';
import Kezdolap from './components/Kezdolap';
import Bejelentkezes from './components/Bejelentkezes';
import Regisztracio from './components/Regisztracio';
import { Route, Routes } from 'react-router-dom';

export default function App(){
    return (
        <>
          <Header />
          <Main />
          <Footer />
{/*           <Routes>
            <Route path="/" element={<VendegLayout/>}/>
            <Route index element={<Kezdolap/>}/>
            <Route path="bejelentkezes" element={<Bejelentkezes/>}/>
            <Route path="regisztracio" element={<Regisztracio/>}/>
          </Routes> */}
        </>
      );
    }
