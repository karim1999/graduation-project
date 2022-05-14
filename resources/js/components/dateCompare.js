import React, { useState } from 'react';
import { Col } from 'react-bootstrap';
import Truck from '../assets/truck.svg';
import './dateCompare.scss';
import DatePicker from "react-datepicker";

const DateCompare = ({value}) => {
    const [date, setDate] = useState(new Date());
    console.log({date});

    return (
        <Col md={2}>
            <div className="mb-3">
                <img src={Truck} alt="Truck" />
                <span className="ms-3">Move-in Date</span>
            </div>
            <DatePicker className="inputDate iconDate"
                        name="pickDate"
                        selected={date}
            />
        </Col>
    );
};

export default DateCompare;
