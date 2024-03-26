import React from "react";

const AllasKartya = ({ job }) => {
  return (
    <div className="job-card">
      <div className="job-info">
        {/* Assuming there's no image property in the job object */}
        {/* If there is, adjust accordingly */}
        <div className="details">
          <h2>{job.title}</h2>
          <p>{job.description}</p>
          {/* Assuming there's no location property in the job object */}
          {/* If there is, adjust accordingly */}
          {/* <p>Hely: {job.location}</p> */}
        </div>
      </div>
      <div className="actions">
        <button>
          <i className="fas fa-edit"></i> Edit
        </button>
        <button>
          <i className="fas fa-trash-alt"></i> Delete
        </button>
      </div>
    </div>
  );
};

export default AllasKartya;
