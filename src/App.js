import React from "react";
import Signup from "./components/signup";
import SignIn from "./components/signin";
import Home from "./components/home";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";
import "./App.css";
import "./batman.jpg";

function App() {
  return (
    <div className="app1">
      {/*  <h1 className="title">Welcome!!</h1> */}

      <Router>
        <Switch>
          <Route path="/" exact component={Signup} />
          <Route path="/signin" exact component={SignIn} />
          <Route path="/home" exact component={Home} />
        </Switch>
      </Router>
    </div>
  );
}

export default App;
