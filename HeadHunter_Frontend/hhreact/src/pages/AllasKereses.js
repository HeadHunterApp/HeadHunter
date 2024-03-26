import React, { useState } from "react";
import Header from "../components/Header";
import Footer from "../components/Footer";
import "../styles/Fooldal.css";
import "../styles/Admin_allasok.css";
import AllasKartya2 from '../components/AllasKartya2';
import allasadat from '../tesztadatok/allasadat'; // Import jobData

const AllasKereses = () => {
  const [searchQuery, setSearchQuery] = useState('');
  const [searchedJobs, setSearchedJobs] = useState(allasadat); // Initial state with all jobs

  // Function to handle search input change
  const handleSearchChange = (e) => {
    setSearchQuery(e.target.value);
  };

  // Function to handle search button click
  const handleSearch = () => {
    if (searchQuery.trim() === "") {
      setSearchedJobs(allasadat); // Reset to all jobs if search query is empty
    } else {
      const filteredJobs = allasadat.filter(job =>
        job.title.toLowerCase().includes(searchQuery.toLowerCase())
      );
      setSearchedJobs(filteredJobs);
    }
  };

  return (
    <div>
      <Header />
      <main>
        <div className="search-bar">
          <input 
            type="text" 
            placeholder="Keresés..." 
            value={searchQuery} 
            onChange={handleSearchChange} 
          />
          <button onClick={handleSearch}>Search</button> {/* Search button */}
        </div>
        {/* Display searched job opportunities */}
        {searchedJobs.length > 0 && searchedJobs.map(job => (
          <AllasKartya2 key={job.id} job={job} />
        ))}
      </main>
      <Footer />
    </div>
  );
};

export default AllasKereses;
