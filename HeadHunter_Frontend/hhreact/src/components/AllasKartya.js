import React from "react";
const AllasKartya =()=>{
return(
<div className="job-card">
          <div className="job-info">
            <img src="https://via.placeholder.com/50" alt="Profile Picture" />
            <div className="details">
              <h2>Álláshirdetés 1</h2>
              <p>
                Leírás: Lorem ipsum dolor sit amet, consectetur adipiscing
                elit. Integer nec odio. Praesent libero.
              </p>
              <p>Hely: City, Country</p>
            </div>
          </div>
          <div className="actions">
            <button><i className="fas fa-edit"></i> Edit</button>
            <button><i className="fas fa-trash-alt"></i> Delete</button>
          </div>
        </div>
);
};

export default AllasKartya ;