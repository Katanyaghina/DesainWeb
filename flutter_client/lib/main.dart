import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'providers/proposal_provider.dart';
import 'screens/proposal_form_screen.dart';
import 'screens/proposal_track_screen.dart';
import 'screens/proposal_admin_screen.dart';

void main() {
  runApp(
    MultiProvider(
      providers: [
        ChangeNotifierProvider(create: (_) => ProposalProvider()..loadRecentProposals()),
      ],
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Platform Penawaran Desain Web',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primaryColor: const Color(0xFF00236f),
        colorScheme: ColorScheme.fromSeed(
          seedColor: const Color(0xFF00236f),
          primary: const Color(0xFF00236f),
          secondary: const Color(0xFF0058be),
        ),
        scaffoldBackgroundColor: const Color(0xFFf7f9fb),
        useMaterial3: true,
      ),
      home: const MainNavigation(),
    );
  }
}

class MainNavigation extends StatefulWidget {
  const MainNavigation({Key? key}) : super(key: key);

  @override
  State<MainNavigation> createState() => _MainNavigationState();
}

class _MainNavigationState extends State<MainNavigation> {
  int _selectedIndex = 0;
  String? _autoTrackCode;

  void _onSubmissionSuccess(String code) {
    setState(() {
      _autoTrackCode = code;
      _selectedIndex = 1; // Switch to track tab
    });
  }

  @override
  Widget build(BuildContext context) {
    final List<Widget> screens = [
      ProposalFormScreen(onSubmissionSuccess: _onSubmissionSuccess),
      ProposalTrackScreen(
        key: ValueKey(_autoTrackCode), // Force recreate to trigger auto-search on new code
        initialCode: _autoTrackCode,
      ),
      const ProposalAdminScreen(),
    ];

    return Scaffold(
      body: IndexedStack(
        index: _selectedIndex,
        children: screens,
      ),
      bottomNavigationBar: BottomNavigationBar(
        currentIndex: _selectedIndex,
        onTap: (index) {
          setState(() {
            if (index == 0) {
              _autoTrackCode = null; // Clear auto-track code when returning to form
            }
            _selectedIndex = index;
          });
        },
        selectedItemColor: const Color(0xFF00236f),
        unselectedItemColor: Colors.grey,
        items: const [
          BottomNavigationBarItem(
            icon: Icon(Icons.edit_document),
            label: 'Ajukan',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.track_changes),
            label: 'Lacak',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.admin_panel_settings),
            label: 'Admin',
          ),
        ],
      ),
    );
  }
}
