# groups-test

#Test for layered permissions
Description:
The purpose of this example is to explore a granular permission system. The example consist of just one (business) entity, named contact. We have the folowing other entities:
* Groups, which is a level within the organization. Members of a group can access all entities lower in the hierarchy. Members of a group can never access entities higher in the hierarchy.
* Users, speaks for itself
* Roles (not sure weather to use them)
* Permissions, what can somebody do
There is a ContactVoter that currenty rendomly give access to the entity an to one or more actions

#What to do:
Adjust the Voter that is uses the hierarchy for the permissions.
