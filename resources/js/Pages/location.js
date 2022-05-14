import React from 'react';
import SecondFooter from '../components/secondFooter';
import HrLine from '../components/hrLine';
import styles from './location.module.scss';
import FormLocation from '../components/formLocation';
import InfoForm from '../components/infoForm';
import { Row, Col, Button } from 'react-bootstrap';
import backArrow from '../assets/backArrow.svg';
import {Inertia} from "@inertiajs/inertia";
import {useFormik} from "formik";

const Location = ({nextStep, fromAddress, toAddress, pickDate, items}) => {
    const onSubmit = (values, { setSubmitting }) => {
        console.log(values)
        Inertia.post(nextStep, {
            items,
            fromAddress: values.fromAddress,
            toAddress: values.toAddress,
            description: values.description,
            pickDate,
        });
    };
    const addressForm = useFormik({
        initialValues: {
            fromAddress: {
                city: "",
                area: "",
                state: "",
                country: "",
                address: "",
                lat: "",
                lng: "",
                mapPosition: {
                    lat: "",
                    lng: ""
                },
                markerPosition: {
                    lat: "",
                    lng: ""
                }
            },
            toAddress: {
                city: "",
                area: "",
                state: "",
                country: "",
                address: "",
                lat: "",
                lng: "",
                mapPosition: {
                    lat: 18.5204,
                    lng: 73.8567
                },
                markerPosition: {
                    lat: 18.5204,
                    lng: 73.8567
                }
            },
            description: "",
        },
        onSubmit,
    });
    const Back = (e) => {
        e.preventDefault();
        history.back();
    };

    return (
        <>
            <form onSubmit={addressForm.handleSubmit} className={styles.location}>
                <h3>Enter the details of your move</h3>
                <HrLine width="50px" />
                <Row className="mt-5" style={{ margin: '0 -15px' }}>
                    <div className={styles.maps}>
                        <FormLocation name="fromAddress" setFieldValue={addressForm.setFieldValue} title="Moving from" />
                        <FormLocation name="toAddress" setFieldValue={addressForm.setFieldValue} title="Moving to" />
                    </div>
                </Row>
                <Row className="mt-5" style={{ margin: '0 -15px', padding: '20px' }}>
                    <InfoForm addressForm={addressForm} />
                </Row>
                <Row className="mt-5" style={{ margin: '0 -15px', padding: '20px' }}>
                    <Col xs={6} sm={4}>
                        {/*<Button onClick={Back} style={styleBtns.btnShadow} variant="light">*/}
                        {/*    <img className="pe-3" src={backArrow} alt="backArrow" /> Back To*/}
                        {/*    Inventory*/}
                        {/*</Button>*/}
                    </Col>
                    <Col xs={6} sm={{ span: 4, offset: 4 }}>
                        <Button
                            type="submit"
                            style={{ ...styleBtns.btnShadow, ...styleBtns.btnColor }}
                            variant="light"
                        >
                            Save Details
                        </Button>
                    </Col>
                </Row>
            </form>
            <SecondFooter />
        </>
    );
};

const styleBtns = {
    btnShadow: {
        boxShadow: ' rgba(100, 100, 111, 0.2) 0px 7px 29px 0px',
        borderRadius: '20px',
    },
    btnColor: {
        backgroundColor: '#A8DADB',
        color: '#fff',
        float: 'right',
        width: '150px',
    },
};

export default Location;
