import React, { useState } from 'react';
import Box from './box';
import classes from './boxs.module.css';

const Boxs = ({setCount, items}) => {
  const [boxs] = useState([
    { id: 1, name: 'small box', size: '12x12.5x17' },
    { id: 2, name: 'small box', size: '15x14.5x20' },
    { id: 3, name: 'small box', size: '16x15.5x22' },
    { id: 4, name: 'small box', size: '17x18.5x25' },
    { id: 5, name: 'small box', size: '20x19.5x26' },
    { id: 6, name: 'small box', size: '22x20.5x27' },
  ]);
  return (
    <div className={classes.boxsContainer}>
      {boxs.map(({ id, ...otherProps }) => (
        <Box count={items[id] || 0} key={id} {...otherProps} setCount={(count) => setCount(id, count)} />
      ))}
    </div>
  );
};

export default Boxs;
