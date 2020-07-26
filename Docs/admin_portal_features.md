# Admin Portal Features

## Modules

1. Donors Verification and Unit Assignment

```
GET /donor/unverified
Get donor details whose verification is in progress

POST /donor/updateVerificationStatus
BODY: DonorId
      isVerified Status(0/1/2)

GET /centres

GET /units
```

2. View User Feedback

```
POST /reviews
BODY: StartDate
      EndDate

Optional
GET /units
```

3. Contributions

```
GET /contribution?startDate=<startDate&endDate=<endDate>

POST /contribution/comment
BODY: ContributionId
      Comment
```

4. Get Insights

```
GET /reports/contributions?startDate=<startDate&endDate=<endDate>

```

5. Modify questionnaire TODO: Modify acc to implementation

```
GET /questionnaire
```

Donor verification page:
View user feedback page
Contributions page: View the contributions and give a feedback so as to how the money is being used.
Report generation page
Add/change/delete questions
