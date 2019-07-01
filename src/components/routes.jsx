import React from "react";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import SignIn from "./signin";

export const Routes = (
  <Router>
    <Switch>
      {/* <Route exact path="/" component={Home} /> */}
      <Route path="/signin" component={SignIn} />
    </Switch>
  </Router>
);
