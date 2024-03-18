import React from "react";
const AllasKartya =()=>{
return(
<div class="job-card">
          <div class="job-info">
            <img src="https://via.placeholder.com/50" alt="Profile Picture" />
            <div class="details">
              <h2>Álláshirdetés 1</h2>
              <p>
                Leírás: Lorem ipsum dolor sit amet, consectetur adipiscing
                elit. Integer nec odio. Praesent libero.
              </p>
              <p>Hely: City, Country</p>
            </div>
          </div>
          <div class="actions">
            <button><i class="fas fa-edit"></i> Edit</button>
            <button><i class="fas fa-trash-alt"></i> Delete</button>
          </div>
        </div>
);
};

export default AllasKartya ;