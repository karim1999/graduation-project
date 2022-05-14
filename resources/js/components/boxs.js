import React, { useState } from 'react';
import Box from './box';
import classes from './boxs.module.css';

const Boxs = ({setCount, items, boxes}) => {
  return (
    <div className={classes.boxsContainer}>
      {boxes.map(({ id, ...otherProps }) => (
        <Box count={items[id] || 0} key={id} {...otherProps} setCount={(count) => setCount(id, count)} />
      ))}
    </div>
  );
};

export default Boxs;
