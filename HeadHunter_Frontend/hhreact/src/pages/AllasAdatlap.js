import React from "react";
import VisszaLink from "../../components/menu/VisszaLink";
import AllasAlap from "../components/allas/AllasAlap";

export default function AllasAdatlap({ jobId }){

  return (
      <>
        <div className="job-info">
          <AllasAlap jobId={jobId}/>
          <VisszaLink />
        </div>
      </>
  );
};