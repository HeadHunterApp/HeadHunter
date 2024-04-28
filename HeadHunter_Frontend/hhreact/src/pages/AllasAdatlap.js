import React from "react";

import AllasAlap from "../components/allas/AllasAlap";
import VisszaLink from "../components/menu/VisszaLink";

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