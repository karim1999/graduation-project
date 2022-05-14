import React from 'react';
import { Container, Row, Col, Form } from 'react-bootstrap';

const InfoForm = ({addressForm}) => {
  return (
    <Container>
      <Row
        style={{ borderBottom: '3px dashed var(--p-color)' }}
        className="pb-4 mt-5"
      >
        <Col className="mb-4" md={4}>
          <Form.Group className="mb-3" controlId="exampleForm.ControlTextarea1">
            <Form.Label>Special Requests & Instructions:</Form.Label>
            <Form.Control
              as="textarea"
              placeholder="We want you to have the best moving experience. Let us know if there's anything we can do to make your move day seamless."
              rows={4}
              name="description"
              onChange={addressForm.handleChange}
              value={addressForm.values.description}
            />
          </Form.Group>
        </Col>
        <Col md={{ span: 4, offset: 2 }} className="">
          <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
            <Form.Label>Email address</Form.Label>
            <Form.Control name="email" type="email" placeholder="name@example.com"
                          onChange={addressForm.handleChange}
                          value={addressForm.values.email}
            />
          </Form.Group>
          <Form.Group className="mb-3" controlId="exampleForm.ControlInput2">
            <Form.Label>Phone number</Form.Label>
            <Form.Control name="phone" type="text" placeholder="+0123456789"
                          onChange={addressForm.handleChange}
                          value={addressForm.values.phone}
            />
          </Form.Group>
        </Col>
      </Row>
    </Container>
  );
};

export default InfoForm;
