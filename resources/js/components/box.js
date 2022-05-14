import React from 'react';
import boxIcon from '../assets/box.svg';
import classes from './box.module.css';
import decreaseBtn from '../assets/decreaseBtn.svg';
import increaseBtn from '../assets/increaseBtn.svg';

const Box = ({ name, size, image_url, count, setCount }) => {
    return (
        <div className={classes.box}>
            <img src={image_url} alt="box" />
            <h4>{name}</h4>
            <small>{size}</small>
            <div className={classes.btns}>
                <img draggable="false" src={decreaseBtn} alt="decrease btn" onClick={() => setCount(count-1)} />
                {count}
                <img draggable="false" src={increaseBtn} alt="increase btn" onClick={() => setCount(count+1)} />
            </div>
        </div>
    );
};

export default Box;
