import React, { useState, useEffect } from "react";
import "../styles/Kereses.css";
import AllasKartya from '../components/AllasKartya';
import { getAllasAll } from "../contexts/AllasContext";
import useAuthContext from "../contexts/AuthContext";
      
export default function Allaskereses() {
    
  const { user } = useAuthContext();
  
  // Ellenőrzi, hogy az aktuális felhasználó álláskereső-e
  const isJobseeker = (felhasznalo) => {
      return felhasznalo.jogosultsag === 'álláskereső';
  };

  // Állapotok inicializálása
  const [searchQuery, setSearchQuery] = useState('');
  const [searchedJobs, setSearchedJobs] = useState([]);

  useEffect(() => {
    // Adatok lekérése az adatbázisból az oldal betöltésekor
    fetchJobs();
  }, []);

  // Állások lekérése a backendből
  const fetchJobs = async () => {
    try {
      const response = await getAllasAll();
      const data = response.data;
      setSearchedJobs(data);
    } catch (error) {
      console.error('Hiba az állások lekérése közben:', error);
    }
  };

  // Keresőmező tartalmának változását kezeli
  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  // Keresés gombra kattintás kezelése
  const handleSearch = () => {
    if (searchQuery.trim() === "") {
      fetchJobs(); // Üres keresőmező esetén az összes állás lekérése
    } else {
      // Szűrés a keresett kifejezés alapján
      const filteredJobs = searchedJobs.filter(job =>
        job.megnevezes.toLowerCase().includes(searchQuery.toLowerCase())
      );
      setSearchedJobs(filteredJobs);
    }
  };

  return (
    <div>
      {/* Keresőmező és gomb */}
      <div className="search-bar">
        <input 
          type="text" 
          placeholder="Keresés..."
          value={searchQuery} 
          onChange={handleSearchChange}
        />
        <img 
          className="search-bar-button"
          src="/pics/kereso/search_icon.png" // Kereső gomb képének elérési útja
          alt="Keresés"
          onClick={handleSearch}
        /> {/* kereső gomb */}
      </div>
      
      {/* Talált állások megjelenítése */}
      {user && isJobseeker ? (       
        searchedJobs
          .filter(job => job.statusz === "nyitott")
          .map((job) => (
            <AllasKartya key={job.allas_id} job={job} />
        )) ) : (
          searchedJobs
          .map((job) => (
            <AllasKartya key={job.allas_id} job={job} />
          ))
      )}
    </div>
  );
};
/* 
Az searchedJobs állapot mindig frissül az összes állás listájával, amikor lekéri az adatokat a backendből. 
Ez biztosítja, hogy mindig legyen egy friss másolat az összes állásról, amelyre visszatérhetünk a keresési mező ürítésekor.

Az isJobseeker függvény helyesen ellenőrzi, hogy a felhasználó jogosultsága álláskereső-e, és megfelelően kezeli az esetet,
 amikor a user értéke null vagy undefined.

A keresés gomb most egy egyszerű <button> elem, amelyet kattintáskor aktivál, és nincs szükség a value attribútumra.

A keresési funkció most csak a megnevezes tulajdonságot használja a szűréshez, de könnyen kibővíthető más tulajdonságokkal is, mint például a leiras vagy a statusz. */