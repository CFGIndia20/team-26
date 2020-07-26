import React from "react";
import { Route, Redirect } from "react-router-dom";
import { validateSession } from "./Common";

import { Spinner } from "reactstrap";

class PublicRoute extends React.Component {
    constructor(props) {
        super(props);
        this.state = { authorized: null };
    }

    componentDidMount() {
        validateSession().then((authorized) => this.setState({ authorized }));
    }
    render() {
        if (this.state.authorized === false) {
            const { component: Component, ...rest } = this.props;
            return <Route {...rest} render={(props) => <Component {...props} />} />;
        } else if (this.state.authorized === true) {
            return (
                <Redirect
                    to={{
                        pathname: "/dashboard",
                        state: { from: this.props.location },
                    }}
                />
            );
        }
        return (
            <Spinner animation="border" role="status">
                <span className="sr-only">Loading...</span>
            </Spinner>
        );
    }
}

export default PublicRoute;
