/* eslint-disable jsx-a11y/anchor-is-valid */
import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import api from "./api";

const Home = ({ history, match }) => {
  const [contacts, setContacts] = useState([]);
  const [birthdays, setBirthdays] = useState([]);
  const [search, setSearch] = useState("");

  useEffect(() => {
    async function loadData() {
      try {
        api.get("/contacts").then(response => {
          setContacts(response.data.data.contacts);
          setBirthdays(response.data.data.birthdays);
        });
      } catch (e) {
        console.error(e.message);
      }
    }
    loadData();
  }, []);

  const handleSubmit = e => {
    e.preventDefault();
    api
      .get(`/contacts/search?q=${search}`)
      .then(response => {
        let { data } = response.data;
        let results = [...new Set(data)];
        results.reduce((acc, current) => {
          return acc;
        }, []);

        setContacts(results);
      })
      .catch(e => console.error(e));
  };

  const onChangeSearch = e => {
    setSearch(e.target.value);
  };
  return (
    <>
      <div className="container">
        <div className="row ">
          <form className="col" onSubmit={e => handleSubmit(e)}>
            <div className="row">
              <div className="input-field">
                <input
                  className="input-field search-bar left s6"
                  placeholder="Buscar"
                  value={search}
                  onChange={e => onChangeSearch(e)}
                />
                <button
                  className="btn waves-effect waves-light green accent-3 right"
                  type="submit"
                  name="action"
                  onClick={e => handleSubmit(e)}
                >
                  Buscar
                </button>
              </div>
            </div>
          </form>
        </div>
        <div className="row">
          <h4 className="header">Aniversariantes do mês</h4>
          <div className="col">
            <div className="collection">
              {contacts.length > 0
                ? birthdays.map((birthday, key) => (
                    <Link
                      className="birthday-box collection-item"
                      key={key}
                      id={birthday.uuid}
                      to={`/contato/${birthday.uuid}`}
                      uuid={birthday.uuid}
                    >
                      <span className="badge">
                        <i className="material-icons">grade</i>
                      </span>
                      {birthday.first_name} {birthday.last_name}
                    </Link>
                  ))
                : "Carregando"}
            </div>
          </div>
        </div>
        <hr />
        <h4 className="header">Contatos</h4>
        <div className="row">
          <div className="col">
            <div className="collection">
              {contacts.length > 0
                ? contacts.map((contact, key) => (
                    <Link
                      className="contact-box collection-item"
                      key={key}
                      id={contact.uuid}
                      to={`/contato/${contact.uuid}`}
                      uuid={contact.uuid}
                    >
                      <span className="badge">{contact.email}</span>
                      {/* <span className="badge">{contact.phones[0].number}</span> */}
                      {contact.first_name} {contact.last_name}
                    </Link>
                  ))
                : "Carregando"}
            </div>
          </div>
        </div>
      </div>
    </>
  );
};
export default Home;
