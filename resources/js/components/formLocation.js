import React from 'react';
import styles from './formLocation.module.scss';
import moveFrom from '../assets/moveFrom.svg';
import Map from "../components/Map";

const FormLocation = ({title, setFieldValue, name}) => {
    return (
        <div className={styles.formLocation}>
            <div className={styles.formLabel}>
                <img src={moveFrom} alt={title} />
                <label>{title}</label>
            </div>
            <Map
                setFieldValue={setFieldValue}
                name={name}
                google={null}
                center={{lat: 18.5204, lng: 73.8567}}
                height='300px'
                zoom={15}
            />
        </div>
    );
};

export default FormLocation;
