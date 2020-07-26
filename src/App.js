import React, { Component } from "react";
import logo from "./logo.svg";
import "./App.css";

import { Container, Row, Col } from "reactstrap";
import { Button, FormGroup, Input, Card, CardText, CardBody, CardHeader } from "reactstrap";

class App extends Component {
    constructor() {
        super();

        // A state can hold anything dynamically. For example here randomVar is any variable.
        this.state = {
            title: "",
            notes: [],
            newNote: "",
            invalid: false,
        };
    }

    handleChange = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
    };

    handleSubmit = async (event) => {
        if (this.state.newNote.length === 0 || this.state.title.length === 0) {
            this.setState({ invalid: true });
        } else {
            let arr = this.state.notes;
            arr.push([this.state.title, this.state.newNote]);

            await this.setState({ invalid: false, newNote: "", notes: arr, title: "" });
            console.log(this.state.notes);
        }
    };

    // This function renders a component
    render() {
        // Whatever is returned is rendered
        return (
            <div>
                <Container>
                    <h1 className="heading">Take all your notes!!</h1>
                    <Row>
                        <Col>
                            <FormGroup>
                                <Input
                                    type="text"
                                    name="title"
                                    id="newNote"
                                    placeholder="Enter the title!!"
                                    title="Enter the Title!!"
                                    value={this.state.title}
                                    onChange={this.handleChange}
                                />
                            </FormGroup>
                            <FormGroup>
                                <Input
                                    type="text"
                                    name="newNote"
                                    id="newNote"
                                    placeholder="Enter a note!!"
                                    value={this.state.newNote}
                                    onChange={this.handleChange}
                                />
                                {this.state.invalid ? (
                                    <p className="danger">Please enter something!!</p>
                                ) : null}
                            </FormGroup>
                            <Button onClick={this.handleSubmit}>Submit</Button>
                        </Col>
                    </Row>
                    <Row>
                        {this.state.notes.map((note) => (
                            <Col md="4">
                                <Card>
                                    <CardHeader>{note[0]}</CardHeader>
                                    <CardBody>
                                        <CardText>{note[1]}</CardText>
                                    </CardBody>
                                </Card>
                            </Col>
                        ))}
                    </Row>
                </Container>
            </div>
        );
    }
}

export default App;
