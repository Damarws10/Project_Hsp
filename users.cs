using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Db_hsp
{
    #region Users
    public class Users
    {
        #region Member Variables
        protected unknown _id;
        protected string _name;
        protected string _email;
        protected unknown _email_verified_at;
        protected string _password;
        protected unknown _role;
        protected string _remember_token;
        protected unknown _created_at;
        protected unknown _updated_at;
        #endregion
        #region Constructors
        public Users() { }
        public Users(string name, string email, unknown email_verified_at, string password, unknown role, string remember_token, unknown created_at, unknown updated_at)
        {
            this._name=name;
            this._email=email;
            this._email_verified_at=email_verified_at;
            this._password=password;
            this._role=role;
            this._remember_token=remember_token;
            this._created_at=created_at;
            this._updated_at=updated_at;
        }
        #endregion
        #region Public Properties
        public virtual unknown Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Name
        {
            get {return _name;}
            set {_name=value;}
        }
        public virtual string Email
        {
            get {return _email;}
            set {_email=value;}
        }
        public virtual unknown Email_verified_at
        {
            get {return _email_verified_at;}
            set {_email_verified_at=value;}
        }
        public virtual string Password
        {
            get {return _password;}
            set {_password=value;}
        }
        public virtual unknown Role
        {
            get {return _role;}
            set {_role=value;}
        }
        public virtual string Remember_token
        {
            get {return _remember_token;}
            set {_remember_token=value;}
        }
        public virtual unknown Created_at
        {
            get {return _created_at;}
            set {_created_at=value;}
        }
        public virtual unknown Updated_at
        {
            get {return _updated_at;}
            set {_updated_at=value;}
        }
        #endregion
    }
    #endregion
}