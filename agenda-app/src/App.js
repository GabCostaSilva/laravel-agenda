/* eslint-disable jsx-a11y/anchor-is-valid */
import React from "react";
import { useEffect } from "react";
import M from "materialize-css";
import { BrowserRouter as Router, Switch, Route, Link } from "react-router-dom";

import ContactCreate from "./ContactCreate";
import ContactDetail from "./ContactDetail";
import Home from "./Home";

function App() {
  useEffect(() => {
    M.AutoInit();
  });
  return (
    <Router>
      <div>
        <nav>
          <div className="nav-wrapper">
            <a href="#" data-target="mobile-demo" className="sidenav-trigger">
              <i className="material-icons">menu</i>
            </a>
            <ul id="nav-mobile" className="right hide-on-med-and-down">
              <li key="home">
                <Link to="/">Home</Link>
              </li>
              <li key="contatos">
                <Link to="#">Contatos</Link>
              </li>
              <li key="novo-contato">
                <Link to="/novo-contato">Novo Contato</Link>
              </li>
            </ul>
          </div>
        </nav>
        <ul className="sidenav" id="mobile-demo">
          <li>
            <Link to="/novo-contato">Novo Contato</Link>
          </li>
          <li>
            <Link to="/">Home</Link>
          </li>
        </ul>
      </div>
      <div className="container">
        <Switch>
          <Route exact path="/novo-contato">
            <ContactCreate />
          </Route>
        </Switch>
        <Switch>
          <Route exact path="/">
            <Home />
          </Route>
        </Switch>
        <Switch>
          <Route path="/contato/:uuid" children={<ContactDetail />}></Route>
        </Switch>
      </div>
    </Router>
  );
}

export default App;
