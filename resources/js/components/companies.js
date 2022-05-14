import React, { useState } from 'react';
import Company from '../components/company';

const Companies = () => {
  const [companiesData] = useState([
    { id: '1' },
  ]);
  return (
    <div>
      {companiesData.map(({ id }) => (
        <Company key={id} />
      ))}
    </div>
  );
};

export default Companies;
