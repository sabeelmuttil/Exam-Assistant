#include <iostream>
#include <fstream>
#include <string>
# include <stdlib.h>
using namespace std;
inline bool exist(const std::string& name)
{
								ifstream file(name);
								if(!file)      // If the file was not found, then file is 0, i.e. !file=1 or true.
																return false; // The file was not found.
								else           // If the file was found, then file is non-0.
																return true; // The file was found.
}


int main (int argc, char *argv[])
{
								int COUNT=0;
								//cout << argv[1] << endl;
								//contains argument 1
								//check if exam exists;
								if(argc>1) {
																COUNT=atoi(argv[1]);
								}
								int seedval;
								int trees[1000]={0};
								string Stree[1000];
								if (exist("exam.flag")) {
																ifstream seedvalpool;
																seedvalpool.open("seedval.pool");
																seedvalpool>>seedval;
																ifstream trees;//question list (selected)
																trees.open("trees.pool");
																for(int i = 0; i < COUNT; ++i)
																{
																								trees >> Stree[i];
																}


								}
								else{
																//Starting exam

								}
								return 0;
}
