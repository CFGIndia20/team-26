import React from "react";

// reactstrap components
import { Card, CardHeader, Table, Container, Row, Col, FormGroup, Input, CardBody } from "reactstrap";
// core components
import Header from "components/Headers/Header.js";

import AdminFooter from "components/Footers/AdminFooter.js";

class Tables extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            trips: [
                { tripId: "esoignweos", conductorId: "eaiofnoeig" },
                { tripId: "esgiongw", conductorId: "erhoiner" },
                { tripId: "wigniipwe", conductorId: "tnohirmt" },
                { tripId: "wroniowrg", conductorId: "erhione" },
            ],
            filteredTrips: [],
            searchDetails: "",
        };
    }
    componentDidMount() {
        this.setState({ filteredTrips: this.state.trips });
    }

    onSearchChangeHandler = (event) => {
        this.setState({ searchDetails: event.target.value }, () => {
            let filteredTrips = [];

            if (this.state.searchDetails === "") {
                filteredTrips = this.state.trips;
            } else {
                filteredTrips = this.state.trips.filter(this.filterTrip);
                console.log(filteredTrips);
            }
            this.setState({ filteredTrips: filteredTrips });
        });
    };

    filterTrip = (element) => {
        console.log(this.state.searchDetails);
        const res =
            element.tripId.includes(this.state.searchDetails) ||
            element.conductorId.includes(this.state.searchDetails);
        return res;
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
                                    <h3 className="mb-0">Trips</h3>
                                </CardHeader>
                                <CardBody>
                                    {/* <Form> */}
                                    <Row>
                                        <Col lg="6">
                                            <FormGroup>
                                                <label className="form-control-label" htmlFor="searchDetails">
                                                    Search Trip
                                                </label>
                                                <Input
                                                    className="form-control-alternative"
                                                    id="searchDetails"
                                                    placeholder="Enter Search Keyword"
                                                    name="searchDetails"
                                                    type="text"
                                                    onChange={this.onSearchChangeHandler}
                                                />
                                            </FormGroup>
                                        </Col>
                                    </Row>
                                    {/* </Form> */}

                                    <Table className="align-items-center table-flush" responsive>
                                        <thead className="thead-light">
                                            <tr>
                                                <th scope="col">TripId</th>
                                                <th scope="col">ConductorId</th>
                                                {/* <th scope="col" /> */}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {this.state.filteredTrips.map((trip) => (
                                                <tr>
                                                    <td>{trip.tripId}</td>
                                                    <td>{trip.conductorId}</td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </Table>
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
