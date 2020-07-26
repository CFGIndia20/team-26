/*!

=========================================================
* Argon Dashboard React - v1.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-react
* Copyright 2019 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard-react/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

*/
import React from "react";
import axios from "axios";

// reactstrap components
import {
    Button,
    Card,
    CardBody,
    FormGroup,
    Form,
    Input,
    InputGroupAddon,
    InputGroupText,
    InputGroup,
    Col,
} from "reactstrap";

class Login extends React.Component {
    constructor() {
        super();

        this.state = {
            email: "",
            password: "",
            disabled: false,
        };
    }

    handleChange = (event) => {
        this.setState({ [event.target.name]: event.target.value });
    };

    handleSubmit = (event) => {
        this.setState({ disabled: true });
        //
        event.preventDefault();

        let user = {
            email: this.state.email,
            password: this.state.password,
        };

        axios
            .post(`https://jpmc-auth.herokuapp.com/api/login`, user)
            .then((res) => {
                console.log(res.data);
                if (res.data.meta.success === true) {
                    localStorage.setItem("token", res.data.payload.token);
                    // cookie.save("token", res.data.payload.token, {
                    //     path: "/",
                    // });
                    this.props.history.push("/admin");
                }
            })
            .catch((error) => {
                this.setState({ disabled: false, email: "", password: "" });
            });
    };

    render() {
        return (
            <>
                <Col lg="5" md="7">
                    <Card className="bg-secondary shadow border-0">
                        <CardBody className="px-lg-5 py-lg-5">
                            <Form role="form">
                                <FormGroup className="mb-3">
                                    <InputGroup className="input-group-alternative">
                                        <InputGroupAddon addonType="prepend">
                                            <InputGroupText>
                                                <i className="ni ni-email-83" />
                                            </InputGroupText>
                                        </InputGroupAddon>
                                        <Input
                                            name="email"
                                            placeholder="Email"
                                            type="email"
                                            autoComplete="new-email"
                                            value={this.state.email}
                                            onChange={this.handleChange}
                                            required
                                        />
                                    </InputGroup>
                                </FormGroup>
                                <FormGroup>
                                    <InputGroup className="input-group-alternative">
                                        <InputGroupAddon addonType="prepend">
                                            <InputGroupText>
                                                <i className="ni ni-lock-circle-open" />
                                            </InputGroupText>
                                        </InputGroupAddon>
                                        <Input
                                            name="password"
                                            placeholder="Password"
                                            type="password"
                                            autoComplete="new-password"
                                            value={this.state.password}
                                            onChange={this.handleChange}
                                            required
                                        />
                                    </InputGroup>
                                </FormGroup>
                                {/* <div className="custom-control custom-control-alternative custom-checkbox">
                  <input
                    className="custom-control-input"
                    id=" customCheckLogin"
                    type="checkbox"
                  />
                  <label
                    className="custom-control-label"
                    htmlFor=" customCheckLogin"
                  >
                    <span className="text-muted">Remember me</span>
                  </label>
                </div> */}
                                <div className="text-center">
                                    <Button
                                        className="my-4"
                                        color="primary"
                                        type="button"
                                        onClick={this.handleSubmit}
                                        disabled={this.state.disabled ? true : ""}
                                    >
                                        Sign in
                                    </Button>
                                </div>
                            </Form>
                        </CardBody>
                    </Card>
                </Col>
            </>
        );
    }
}

export default Login;
