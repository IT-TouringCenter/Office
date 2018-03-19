/*DROP PROCEDURE IF EXISTS*/
DROP FUNCTION IF EXISTS nst_fn_getIdentifies_reserveIdentifies;

/*CREATE PROCEDURE*/
DELIMITER $$

CREATE FUNCTION nst_fn_getIdentifies_reserveIdentifies (activityId INT)
RETURNS VARCHAR(10)
BEGIN
    
	DECLARE tmpId varchar(10);	
	DECLARE isExists INT;
	
	SELECT nst_fn_generateIdentifies() into tmpId;
	SELECT count(identify) INTO isExists FROM reserve_identifies WHERE identify = tmpId;
	
	WHILE isExists > 0 DO
		SELECT nst_fn_generateIdentifies() into tmpId;
		SELECT count(identify) INTO isExists FROM reserve_identifies WHERE identify = tmpId;	
	END WHILE;
	
	CALL nst_sp_insert_reserveIdentifies(tmpId,activityId);
	
	RETURN tmpId;
	
end $$

DELIMITER ;
