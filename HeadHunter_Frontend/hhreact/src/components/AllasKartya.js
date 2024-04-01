import React from "react";

/*  ----  EZ TÖRÖLHETŐ? !!!MARCI!!!  -----  */

const AllasKartya =(allas)=>{
return(
<div className="job-card">
          <div className="job-info">
            <img src="https://via.placeholder.com/50" alt="Profile Picture" />
            <div className="details">
              <h2>{allas.munkaltato} </h2>
              <p>
                {allas.megnevezes}
              </p>
              <p>{allas.pozicio}</p>
              <p>{allas.statusz}</p>
              <p>{allas.leiras}</p>
              <p>{allas.datum}</p>
              <p>{allas.fejvadasz}</p>
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