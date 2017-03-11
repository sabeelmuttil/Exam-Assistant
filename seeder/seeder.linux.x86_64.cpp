#include <iostream>
#include <fstream>
#include <string>
#include <stdlib.h>
using namespace std;
inline bool exist(const std::string& name)
{
								ifstream file(name);
								if(!file)      // If the file was not found, then file is 0, i.e. !file=1 or true.
																return false; // The file was not found.
								else           // If the file was found, then file is non-0.
																return true; // The file was found.
}
inline double randd() {
								return (double)rand() / ((double)RAND_MAX + 1);
}

int main (int argc, char *argv[])
{
								int f1=0;
								int fn=0;
								int COUNT=0;
								cout << argv[1] << endl;
								cout << argv[2] << endl;
								srand((unsigned int)time(NULL));
								std::cout << "Seeded randomizer" << '\n';
								//contains argument 1
								//check if exam exists;
								if(argc>2) {
																f1=atoi(argv[1]);
																fn=atoi(argv[2]);
																COUNT=fn-f1;
								}
								//int trees[1000]={0};
								string Stree[1000];
								std::cout << "no string isssue" << '\n';
								if (exist("exam.flag")) {
																std::cout << "countinuation of exam" << '\n';
																ifstream trees;//question list (selected)
																trees.open("trees.pool");
																std::cout << "opening question list..." << '\n';

																for(int i = 0; i < COUNT; ++i)
																{
																								trees >> Stree[i];

																}
																//Shuffling algorithm
																std::cout << "Shuffling ..." << '\n';

																int rndnum=-99;
																for (int i = 0; i < COUNT-2; i++) {
																								do {
																																rndnum=rand()%COUNT;
																																std::cout << rndnum << '\n';
																								} while(!(i<=rndnum&&COUNT>rndnum));
																								//swap
																								string ti;
																								ti=Stree[i];
																								Stree[i]=Stree[rndnum];
																								Stree[rndnum]=ti;

																}//End of algorithm
																std::cout << "finished shuffling :)" << '\n';
																trees.close();
																ofstream output;
																output.open("output.txt");
																for (int i = 0; i < COUNT; i++) {
																								output<<Stree[i]<<" ";
																}


								}
								else{
																//Starting new exam
																//create file exam.flag
																ofstream flag;
																std::cout << "creating flag , starting new exam" << '\n';
																flag.open("exam.flag");
																ofstream wtrees;
																wtrees.open("trees.pool");
																//opened trees to write questions
																for (int i = f1; i < fn; i++) {
																								wtrees<<i<<" ";
																}
																//written leaves
																wtrees.close();
																ifstream trees;//question list (selected)
																trees.open("trees.pool");
																for(int i = 0; i < COUNT; ++i)
																{
																								trees >> Stree[i];

																}
																//Shuffling algorithm

																int rndnum=-99;
																for (int i = 0; i < COUNT-2; i++) {
																								do {
																																rndnum=rand()%COUNT;
																								} while(!(i<=rndnum&&COUNT>rndnum));
																								//swap
																								string ti;
																								ti=Stree[i];
																								Stree[i]=Stree[rndnum];
																								Stree[rndnum]=ti;

																}//End of algorithm
																trees.close();
																ofstream output;
																output.open("output.txt");
																for (int i = 0; i < COUNT; i++) {
																								output<<Stree[i]<<" ";;
																}



								}
								return 0;
}
