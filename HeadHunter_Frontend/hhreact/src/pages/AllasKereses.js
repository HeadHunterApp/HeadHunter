import React, { useState, useEffect } from "react";
import "../styles/Kereses.css";
import AllasKartya from '../components/AllasKartya';

/*  ----  EZT LEHET KOMPONENSSÉ KELLENE MAJD TENNI, ÉS AZ EREDMÉNYMEGJELENÍTŐS RÉSZE LENNE A PAGE,
      EZT PEDIG CSAK MEGHÍVNÁNK OTT  -----  */


      
const Allaskereses = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchedJobs, setSearchedJobs] = useState([]);

  useEffect(() => {
    // minden adat a backendből
    fetchJobs();
  }, []);

  // a jobdatat szedi ki
  const fetchJobs = async () => {
    try {
      const response = await fetch('http://localhost:8000/api/guest/jobs/all');
      if (!response.ok) {
        throw new Error('Failed to fetch job data');
      }
      const data = await response.json();
      // alals id és fejvadássz kizárása talán nem is fontos :D
      const filteredData = data.map(({ allas_id, fejvadasz, ...rest }) => rest);
      setSearchedJobs(filteredData);
    } catch (error) {
      console.error('Error fetching job data:', error);
    }
  };

  // keresés változtatást kezeli
  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  // kereső gomb kattintás kezelő
  const handleSearch = () => {
    if (searchQuery.trim() === "") {
      fetchJobs(); // resetel minden állásra ha üres a mező
    } else {
      const filteredJobs = searchedJobs.filter(job =>
        job.megnevezes.toLowerCase().includes(searchQuery.toLowerCase())
      );
      setSearchedJobs(filteredJobs);
    }
  };

  return (
    <div>
        
        <div className="search-bar" >
          <input type="text" placeholder="Keresés..."
            value={searchQuery} 
            onChange={handleSearchChange}
            />
          <img className="search-bar-button"
            src="/pics/kereso/search_icon.png"
            alt="Keresés"
            value={searchQuery}
            onClick={handleSearch}
          /> {/* kereső gomb */}
        </div>
        {/*mappal kiirja a talált állásokat */}
        {searchedJobs.map((job) => (
          <AllasKartya key={job.allas_id} job={job} />
        ))}
    </div>
  );
};

export default Allaskereses;
