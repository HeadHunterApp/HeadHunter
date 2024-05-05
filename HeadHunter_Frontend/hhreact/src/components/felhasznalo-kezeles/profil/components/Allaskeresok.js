import React, { useState, useEffect } from "react";
import "../../../../styles/Kereses.css";
import { getAllAllaskeresoforFejvadaszAdmin } from "../../../../contexts/AllaskeresoContext";
import useAuthContext from "../../../../contexts/AuthContext";
import AllaskeresoKartya from "../../AllaskeresoKartya";

      
export default function Allaskeresok() {
    
  const { user, isAdmin, isHeadhunter } = useAuthContext();

  // Állapotok inicializálása
  const [searchQuery, setSearchQuery] = useState('');
  const [searchedSeekers, setSearchedSeekers] = useState([]);

  useEffect(() => {
    // adatok lekérése az adatbázisból az oldal betöltésekor
    fetchSeekers();
  }, []);

  // Álláskeresők szociális készségek lekérése a backendből
  const fetchSeekers = async () => {
    try {
      const response = await getAllAllaskeresoforFejvadaszAdmin();
      const data = response.data;

      console.log(data);
      setSearchedSeekers(data);
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
      fetchSeekers(); // Üres keresőmező esetén az összes álláskereső lekérése
    } else {
      // Szűrés a keresett kifejezés alapján
      const filteredSeekers = searchedSeekers.filter(seeker =>
        seeker.szoc_keszseg.toLowerCase().includes(searchQuery.toLowerCase())
      );
      setSearchedSeekers(filteredSeekers);
    }
  };

  return (
    <div className="allker-border">
    <div className="allker">
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
      
      {/* Talált szociális készségek megjelenítése */}
      {
        user && (isAdmin() || isHeadhunter()) ? (       
        searchedSeekers
          .map((seeker) => (
            <AllaskeresoKartya seeker={seeker} />
        )) ) : "" 
      }
    </div>
    </div>
  );
};
