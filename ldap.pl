#!perl.exe
;use Data::Dumper;
use Net::LDAP;
use Net::LDAP::Util qw(ldap_error_text ldap_error_name ldap_error_desc );

my $sam_name= shift;
my $usr_pass= shift;

my $flag=0;
my $user="AVM5AS744";
my $pass='sudarshan9@S';
my $ldap = Net::LDAP->new("bluepages.ibm.com", version => 3)  or die "Could not connect!";
my $mesg = $ldap->start_tls(verify=>none);
my $mesg = $ldap->bind($user,password=>$pass,) or die "Could not bind!";
# Declare the necessary search variables
my ($usr_dn,$usr_cn);

# search base
my $searchbase = 'ou=bluepages,o=ibm.com';

# What are we searching for?
my $searchString="(&(emailAddress=$sam_name))";

# Execute the search
my $results = $ldap->search ( base    => "$searchbase",
								scope   => "sub",
								filter  => "$searchString",
							  );

# How many entries returned?
my $count = $results->count;
#print Dumper($count);

if ($count == 1)
{
	foreach my $entry ($results->entries)
	{
		$usr_uid= $entry->get_value("uid");
		$usr_c= $entry->get_value("c");
		$usr_cn= $entry->get_value("cn");
	}
	$flag=1;
}
else
{
	#  User Not Matched!
	#print qq(<script>alert('User does Not exist')</script>);
	print "NotPresent";
	exit;
}

$usr_dn= "uid=".$usr_uid.",c=".$usr_c.',ou=bluepages,o=ibm.com';
#print Dumper($usr_dn);
#print Dumper($usr_pass);
$ldap->unbind;

# Authenticate Login User
if($flag==1)
{
	my $usr_ldap = Net::LDAP->new("bluepages.ibm.com", version => 3)  or die "Could not connect!";
	my $mesg = $usr_ldap->start_tls(verify=>none);
	my $mesg = $usr_ldap->bind($usr_dn,password=>$usr_pass,) or die "Could not bind!";
	if($mesg->code )
	{
		my $errstr = $mesg->code;
		#print Dumper($errstr);
		print "NotMatched";
		# return 1;
	}
	else
	{
		# User Login Info Matched!
			print "$user_cn"; open(DATA,">user.txt");print DATA "$usr_cn";
	close(DATA);
#return($usr_cn);
		# return 3;
	}
	# Unbind from the server
	$usr_ldap->unbind;
}
else
{
	return 1;
}