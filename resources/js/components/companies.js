import React, { useState } from 'react';
import Company from '../components/company';

const Companies = ({prices, onSubmit}) => {
  return (
    <div>
      {prices.map(({prices, vendor, total}) => (
        <Company key={vendor.id} prices={prices} total={total} vendor={vendor} onSubmit={onSubmit} />
      ))}
    </div>
  );
};

export default Companies;
