import React, {useState} from 'react';
import './myItems.css';
import Boxs from '../components/boxs';
import SecondFooter from '../components/secondFooter';
import { Button } from 'react-bootstrap';
import {Inertia} from "@inertiajs/inertia";

const MyItems = ({ nextStep, boxes, fromAddress, toAddress, pickDate }) => {
    const [items, setItems] = useState({});
    const Continue = (e) => {
        Inertia.post(nextStep, {
            items,
            fromAddress,
            toAddress,
            pickDate
        });
    };
    const setCount = (id, count) => {
        setItems({
            ...items,
            [id]: count >= 0 ? count : 0
        })
    }
    return (
        <>
            <div className="myItems">
                <Button className="btnNext" variant="dark" onClick={Continue}>
                    Continue
                </Button>
                <Boxs items={items} setCount={setCount} />
            </div>
            <SecondFooter />
        </>
    );
};

export default MyItems;
