import React from 'react';
import '../styles/AllasKartya.css';

const AllasKartya2 = ({ job }) => {
  return (
    <div className="job-card">
      <div className="job-title">
        <h2>{job.megnevezes}</h2>
      </div>
      <div className="job-description">
        <p>{job.leiras}</p>
      </div>
      <div className="apply-button">
        <button>Jelentkezés</button>
      </div>
    </div>
  );
};

export default AllasKartya2;
