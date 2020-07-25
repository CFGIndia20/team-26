# Database Design

## Tables

1. Donor

-   Id
-   UserId
-   isVerified(0: In process, 1: Verified, 2: Rejected)

2. User

-   Id
-   Name
-   Email
-   Phone Number
-   Password
-   Role(Admin/Donor)

4. Units/Categories

-   Id
-   Name
-   Description

5. Donor Units

-   Id
-   Donor Id
-   Unit Id

6. Contributions

-   Id
-   DonorId
-   Description(Money/Description of physical goods)
-   Amount
-   Date
-   AdminFeedback

7. Questionnaire

-   Id
-   UnitId
-   Question

8. Questionnaire Respose TODO: Modify acc to implementation

-   ResponseId
-   QuestionId
-   Response(star(1-9))
-   Date+Time

9. Patient

-   Id
-   HospitalId
-   Mobile Number
