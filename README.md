# Docker mailserver API

WIP

Create email

```
curl "http://api.yourdomain.com/email/create?email=info@domain.com&password=somepassword&token=yoursecrettoken"
```

Update email password

```
curl "http://api.yourdomain.com/email/update?email=info@domain.com&password=somepassword&token=yoursecrettoken"
```

Delete email

```
curl "http://api.yourdomain.com/email/delete?email=info@domain.com&token=yoursecrettoken"
```
