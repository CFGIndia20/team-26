import React from "react";

// reactstrap components
import {
    Card,
    CardHeader,
    Table,
    Container,
    Row,
    CardText,
    CardTitle,
    Col,
    FormGroup,
    Input,
    CardBody,
    Modal,
    ModalHeader,
    ModalBody,
    ModalFooter,
    Button,
    Label,
} from "reactstrap";
// core components
import Header from "components/Headers/Header.js";

import AdminFooter from "components/Footers/AdminFooter.js";

class Tables extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [
                {
                    k: "Max contribution",
                    v: "val",
                },
                {
                    k: "Max contribution",
                    v: "val",
                },
                {
                    k: "Max contribution",
                    v: "val",
                },
            ],
        };
    }

    onChangeHandler = async (event) => {
        await this.setState({ [event.target.name]: event.target.value });
        console.log(this.state);
    };

    render() {
        return (
            <>
                <Header />
                {/* Page content */}
                <Container className="mt--7" fluid>
                    {/* Table */}
                    <Row>
                        <div className="col">
                            <Card className="shadow">
                                <CardHeader className="border-0">
                                    <h3 className="mb-0">Insights</h3>
                                </CardHeader>
                                <CardBody>
                                    <Row>
                                        {this.state.data.map((d) => (
                                            <Col>
                                                <Card>
                                                    <CardBody>
                                                        <CardTitle>{d.k}</CardTitle>
                                                        <CardText>{d.v}</CardText>
                                                    </CardBody>
                                                </Card>
                                            </Col>
                                        ))}
                                    </Row>
                                </CardBody>
                            </Card>
                        </div>
                    </Row>
                </Container>
                <Container fluid>
                    <AdminFooter />
                </Container>
            </>
        );
    }
}

export default Tables;
